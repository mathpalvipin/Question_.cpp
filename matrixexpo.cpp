
#include<bits/stdc++.h>
 using namespace std;

 long long int mul[100][100];
 long long  int ar[100][100];
long long int b[100];
int m=pow(10,9);
 int mul1(int x)
{
    // Creating an auxiliary matrix to store elements
    // of the multiplication matrix
   long long  int mu[x][x];
    for (int i = 0; i < x; i++)
    {
        for (int j = 0; j < x; j++)
        {
            mu[i][j] = 0;
            for (int k = 0; k < x; k++)
                mu[i][j] =(mu[i][j]%m + (mul[i][k]*mul[k][j])%m)%m;
        }
    }

    // storing the multiplication result in a[][]

             for (int i=0; i<x; i++)
        for (int j=0; j<x; j++)
            mul[i][j] = mu[i][j]%m;  // Updating our matrix
}
int mul3(int x)
{
    // Creating an auxiliary matrix to store elements
    // of the multiplication matrix
 int sum=0;
        for (int j = 0; j < x; j++)
        {


                sum =(sum%m+ (mul[0][j]*b[j])%m);

    }
return sum%m;
    // storing the multiplication result in a[][]

          // Updating our matrix
}
int mul2(int x)
{
    // Creating an auxiliary matrix to store elements
    // of the multiplication matrix
  long long  int mu[x][x];
    for (int i = 0; i < x; i++)
    {
        for (int j = 0; j < x; j++)
        {
            mu[i][j] = 0;
            for (int k = 0; k < x; k++)
                mu[i][j] = (mu[i][j]%m  +(mul[i][k]*ar[k][j])%m)%m;
        }
    }

    // storing the multiplication result in a[][]

             for (int i=0; i<x; i++)
        for (int j=0; j<x; j++)
            mul[i][j] = mu[i][j]%m;  // Updating our matrix
}
 int  power(  int n, int x){

 if(n==1)
   {
        for (int i=0; i<x; i++)
        for (int j=0; j<x; j++)
            mul[i][j] = ar[i][j];
   }

 else{
  power(n/2,x);
  if(n%2!=0){
    mul1(x);
    mul2(x);

  }else
     mul1(x);
 }



 }
  int main ()
  { int q;
  cin>>q;
      while(q--)
      {


      int x;
  cin>>x;

 for( int i=0 ;i<x;i++){
    cin>>b[i];
     }
      for( int i=0 ;i<x-1;i++){
        for( int j=0 ;j<x;j++)
        if(j==i+1)
            ar[i][j]=1;
        else
            ar[i][j]=0;
  }
      for( int i=0 ;i<x;i++){
        cin>>ar[x-1][x-i-1];
      }



  int n;
   cin>>n;

   n=n-1;
if(n==1){
      for (int i=0; i<x; i++)
        for (int j=0; j<x; j++)
            mul[i][j] = ar[i][j];
}

    else if( n%2==0){
         power(n,x);
    }

  else
  { power( n-1,x);
mul2(x);
  }


   int sum =mul3(x);
  cout<<sum<<"\n";

  }
return 0;
  }
