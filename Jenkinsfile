pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                git 'https://github.com/kimin-park/project2-msa-cicd.git'
            }
        }
        stage('Build') {
            steps {
                sh 'npm install'
                sh 'npm run build'
            }
        }
        stage('Deploy') {
            environment {
                KUBECONFIG = credentials('your-kubeconfig')
            }
            steps {
                sh 'kubectl apply -f kubernetes/deployment.yaml'
                sh 'kubectl apply -f kubernetes/service.yaml'
            }
        }
    }
}
