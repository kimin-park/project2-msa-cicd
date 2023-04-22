pipeline {
    agent any
    
    stages() {
        stage('git clone') {
            steps() {
                git 'https://github.com/kimin-park/project2-msa-cicd.git'
            }
        }
        
        stage('docker build and push') {
            steps {
                script {
                    def acrServer = "cicd2project.azurecr.io"
                    def imageName = "mysql"
                    def imageTag  = "1.1"
                    def dockerfileDir = "./"
                    def registryCredential = 'Kimin-Park'

                    def dockerImage = docker.build("${acrServer}/${imageName}:${imageTag}", "-f ${dockerfileDir}Dockerfile ${dockerfileDir}")
                    docker.withRegistry("https://${acrServer}", registryCredential) {
                        dockerImage.push()
                    }
                }
            }
        }
        
        stage('deploy terraform') {
            steps {
                sh '''
                sed -i -e 's/image = "mysql:5.7"/image = "cicd2project.azurecr.io\/mysql:1.1"/g' main.tf
                terraform init
                terraform apply -auto-approve
                '''
            }
        }        
    }
}

