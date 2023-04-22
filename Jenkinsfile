pipeline {
    agent {
        Dockerfile true
    }
    stages {
        stage('Example') {
            steps {
                echo 'Hello World!'
                sh 'echo myCustomEnVar = $myCustomEnvVar'
            }
        }
    }
}
