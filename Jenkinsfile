pipeline {
    agent any
    stages {
        stage('git scm update') {
          steps {
              git url: 'https://github.com/kimin-park/project2-msa-cicd.git' , branch: 'main'
          }
        }
        stage('docker build and push') {
            steps {
              sh '''
              docker build -t lkasd7512/jenkins:1.0 .
              docker push lkasd7512/jenkins:1.0
              '''
                
            }
        }
        stage('deploy kubernetes') {
            steps {
                withAzureCLI([azureSubscription(credentialsId: '', subscriptionId: '')]) {
                    sh '''
                    az aks get-credentials --resource-group projec2-msa-cicd --name msacluster
                    kubectl create deployment pl-bulk-prod --image=192.168.1.10:8443/echo-ip
                    kubectl expose deployment pl-bulk-prod --type=LoadBalancer --port=8081 --target-port=80 --name=pl-bulk-prod-
                    '''
                }
            }
        }
    }
}
