pipeline {
    agent {
        kubernetes {
            label 'wordpress'
        }
    }
    stages {
        stage('Build') {
            steps {
                sh 'docker build -t mywordpress:latest .'
                sh 'docker tag mywordpress:latest myacr.azurecr.io/mywordpress:latest'
                sh 'az acr login --name myacr'
                sh 'docker push myacr.azurecr.io/mywordpress:latest'
            }
        }
        stage('Deploy') {
            steps {
                kubernetesDeploy(
                    kubeconfigId: 'mykubeconfig',
                    configs: 'k8s/wordpress.yaml',
                    enableConfigSubstitution: true,
                    enableConfigMapSubstitution: true,
                    forceRollingUpdate: true
                )
            }
        }
    }
}

pipeline {
    agent any
    
    stages {
        stage('Build') {
            steps {
                script {
                    docker.withRegistry('https://my-acr.azurecr.io', 'my-acr-login') {
                        def app = docker.build("my-acr.azurecr.io/my-app:${env.BUILD_NUMBER}", '.')
                        app.push()
                    }
                }
            }
        }
        
        stage('Deploy') {
            steps {
                script {
                    kubernetesDeploy(
                        kubeconfigId: 'my-kubeconfig',
                        configs: 'kubernetes/*.yml',
                        enableConfig
