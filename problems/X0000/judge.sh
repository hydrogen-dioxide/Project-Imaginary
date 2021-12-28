#!bin/bash

# while getopts u:a:f: flag
# do
#    case "${flag}" in
#        u) username=${OPTARG};;
#        a) age=${OPTARG};;
#        f) fullname=${OPTARG};;
#    esac
#done
#echo "Username: $username";
#echo "Age: $age";
#echo "Full Name: $fullname";

echo "<br>";

ID="0000";
TL=1;
ML=1048576;
file=$1;
lang=$2;
# How to get input?
# subtasks especially
problempath="../../problems/${ID}/";

score=0.00; verdict="Pending";

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
}

# idk why -static cause error
compile $lang $file "program"
if [ ! -f program ]; then
  verdict="CE";
  echo "CE<br>";
  TEXT=$(cat error.log);
  echo ${TEXT//$'\n'/<br>};
else
  scores=();
  verdicts=();
  for i in {001..046}
  do
    echo $i;
    
    if [[ "1" != $(timeout ${TL} bash -c "ulimit -v ${ML}; ./program < ${problempath}input/input_$i.txt > $i.out; echo '1'"  2> error.log) ]]
    then
      verdicts+=("TLE");
      scores+=(0.00);
      echo "TLE 0.00";
    else
      if [[ "0" != $(stat -c%s "error.log") ]]
      then
        verdicts+=("RE");
        scores+=(0.00);
        echo "RE 0.00";
      else
        bash ${problempath}format.sh $i.out;
        if diff --strip-trailing-cr "$i.out" "${problempath}input/expect_$i.txt" > /dev/null; 
        then
          verdicts+=("AC");
          scores+=(100.00);
          echo "AC 100.00";
        else
          verdicts+=("WA");
          scores+=(0.00);
          echo "WA 0.00";
        fi
      fi
    # -> output to file(?)
    # -> call sql to ...
    fi
    echo "<br>";
  done
  echo ${scores[@]}; echo ${verdicts[@]};
  for i in {1..8}; do
    echo "TC";
  done
fi