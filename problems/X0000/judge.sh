#!/bin/bash
# 1. compilation (file, lag)
# 2. skip_mode (faster/slower)
# 3. probID, TL, ML, subtasks, test cases

probID="X0000"
TL=2
ML=1048576
STC=3
subtasks=(3 3 4)
scores=(30 30 40)
skip_mode=0
lang=C++17
file=$1

ttod(){ # time to double
	res=$((${1:0:1} * 600000 + ${1:2:1} * 10000 + ${1:3:1} * 1000 + ${1:5:1} * 100 + ${1:6:1} * 10))
	echo $res
}
format(){
	sed -i 's/[[:blank:]]*$//' $1
	sed -i -e '$a\' $1
	echo >> $1
}
# -static?
compile () { # $1 => lang, $2 => file, $3 => name
	if [ $1 == "C" ]; then
		gcc -std=c99 -Wno-unused-result -fno-optimize-sibling-calls -fno-strict-aliasing -fno-asm -DONLINE_JUDGE -s -O2 -o $3 $2 -lm 2> error.log
	elif [ $1 == "C++" ]; then
		g++ -Wno-unused-result -DONLINE_JUDGE -s -O2 -o $3 $2 2> error.log
	elif [ $1 == "C++11" ]; then
		g++ -std=c++11 -Wno-unused-result -DONLINE_JUDGE -s -O2 -Ilib -o $3 $2 2> error.log
	elif [ $1 == "C++14" ]; then
		g++ -std=c++14 -Wno-unused-result -DONLINE_JUDGE -s -O2 -Ilib -o $3 $2 2> error.log
	elif [ $1 == "C++17" ]; then
		g++ -std=c++17 -Wno-unused-result -DONLINE_JUDGE -s -O2 -Ilib -o $3 $2 2> error.log
	elif [ $1 == "C++20" ]; then
		g++ -std=c++20 -Wno-unused-result -DONLINE_JUDGE -s -O2 -Ilib -o $3 $2 2> error.log
	fi
	return $?
}

run(){
	echo 1;
}

tmpPATH=tmp/1323/
problemPATH=
judge( ){ # $1 => test case #, $2 => result
	input=${problemPATH}'input/'$(printf %03d $1)'.in'
	answer=${problemPATH}'output/'$(printf %03d $1)'.out'
	output=${tmpPATH}$(printf %03d $1)'.out'
	# echo $input $answer $output;
	time=0; memory=0; score=0;
	T_M=$(/usr/bin/time --quiet -f "%E %M" bash -c "timeout ${TL} bash -c \"ulimit -v ${ML} 2> error.log; ./program < $input > $output\" 2> error.log" 2>&1)
	error_code=$?
	# echo "Error code:" $error_code
	local -n arr=$2
	arr=($T_M)
	if [[ error_code -eq 124 ]]; then
		arr+=("TLE")
		arr+=(0.00)
	elif [[ error_code -ne 0 ]]; then
		arr+=("RE")
		arr+=(0.00)
	else
		format ${tmpPATH}$(printf %03d $1).out;
		if diff --strip-trailing-cr $output $answer > /dev/null; then
			arr+=("AC")
			arr+=(100.00)
		else
			arr+=("WA")
			arr+=(0.00)
		fi
	fi
}

: '
echo "PROBLEM $probID"
echo subtasks X${STC}: ${subtasks[@]}
echo

compile $lang $file program
if [ $? -ne 0 ]; then echo "CE"; fi

cSubtask=1
cTestcase=1
declare -A rTotal;
declare -A rSubtasks;
declare -A rTestcases;

ttl_result="AC"
ttl_score=0
max_runtime=0
max_memory=0

for i in ${subtasks[@]}; do
	st_result="AC"
	st_last_kill=0
	st_total=${scores[$(bc -l <<< "$cSubtask - 1")]}
	st_score=100
	for j in `seq 1 $i`; do
		printf "TESTCASE #%03d $cSubtask-$j: " $cTestcase
		judge $cTestcase result;
		result[0]=$(ttod ${result[0]})
		echo ${result[@]}
		if [[ ${#result[@]} -lt 4 ]]; then echo "SE"; fi
		for x in `seq 0 3`; do
			rTestcases[$cTestcase,$x]=${result[$x]}
			# echo $cTestcase,$x
		done
		
		st_last_kill=$j
		max_runtime=$(( $(bc -l <<< "$max_runtime > ${result[0]}") ? $max_runtime : ${result[0]} ))
		max_memory=$(( $(bc -l <<< "$max_memory > ${result[1]}") ? $max_memory : ${result[1]} ))
		if [[ "$(echo $st_score \> ${result[3]} | bc -l)" -eq 1 ]]; then
			st_score=${result[3]}
		fi
		# echo $st_score
		if [[ $(echo "${result[3]}!=100.00" | bc -l) -ne 0 ]]; then
			if [[ $st_result == "AC" ]]; then
				st_result=${result[2]}
				ttl_result=${result[2]}
			fi
		fi
		if [[ $(echo "${result[3]}==0.00" | bc -l) -ne 0 ]]; then
			if [[ $st_result == "AC" || $st_result == "PS" ]]; then
				st_result=${result[2]}
				ttl_result=${result[2]}
			fi
			if [[ $skip_mode -ne 0 ]]; then
				let cTestcase+=$i-$j+1
				break
			else
				let cTestcase++
			fi
		else
			let cTestcase++
		fi
	done
	let cSubtask+=1
	# echo $ttl_score+$st_score/100*$st_total
	ttl_score=$(bc -l <<< "scale=2; $ttl_score+$st_score/100*$st_total")
done

echo $ttl_result $ttl_score $max_runtime ms  $max_memory KB  '