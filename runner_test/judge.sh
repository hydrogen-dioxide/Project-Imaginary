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
g++ program.cpp -o program
for ((i=1;i<=3;i++))
do
  bash test.sh program $i
  echo "<br>";

# -> output to file(?)
# -> call sql to ...
done