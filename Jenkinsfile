pipeline {
    agent any
    
    stages() {
        stage('git clone') {
            steps() {
                git 'https://github.com/kimin-park/project2-msa-cicd.git'
            }
        }
        
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        
        stage('execute sh') {
            steps {
                sh "chmod 774 ./project.sh"
                sh "./project.sh"
            }
        }        
    }
}

