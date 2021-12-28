#include <bits/stdc++.h>

using namespace std;

int A[100000001];
int main(){
  int n;
  cin >> n;
  for(int i = 999999999; i >= 999999999 - n; i++){
    A[i + 1] = A[i] + i; // fan of mathematical induction
  }
  
}