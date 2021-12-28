#!/bin/bash

sed -i 's/[[:blank:]]*$//' $1
sed -i -e '$a\' $1