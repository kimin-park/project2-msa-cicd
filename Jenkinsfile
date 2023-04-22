pipeline {
    agent any
    
    stages() {
        stage('git clone') {
            steps() {
                git 'https://github.com/leeseok0916/jenkinsTest.git'
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
