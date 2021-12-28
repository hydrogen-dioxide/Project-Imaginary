#include <bits/stdc++.h>
using namespace std;

bool tom[24][60];

int main(){
  string A;
  int N, ts, tf, i, j, ans=0;
  cin >> N;
  for (i=0; i<N; i++){
    cin >> A >> ts >> tf;
    for (j=ts/100*60+ts%100; j<=tf/100*60+tf%100; j++){
      if (tom[j/60][j%60] == true){
        cout << "Busy Tom";
        return 0;
      }else{
        tom[j/60][j%60] = true;
      }
    }
  }
  for (i=0; i<24*60; i++){
    if (tom[i/60][i%60] == false){
      ans++;
    }
  }
  cout << ans;
}