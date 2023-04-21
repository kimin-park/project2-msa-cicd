pipeline {
    agent any
    environment {
        REGISTRY = "cicd2project.azurecr.io"
        IMAGE_NAME = "mysql"
        IMAGE_TAG = "8.0"
        CONTAINER_NAME = "mysql-aks"
        KUBECONFIG = credentials('kubeconfig')
    }
    stages {
        stage('Build Docker Image') {
            steps {
                script {
                    docker.build("${REGISTRY}/${IMAGE_NAME}:${IMAGE_TAG}", "-f Dockerfile .")
                    docker.withRegistry(REGISTRY, 'acr') {
                        docker.push("${REGISTRY}/${IMAGE_NAME}:${IMAGE_TAG}")
                    }
                }
            }
        }
        stage('Deploy to AKS') {
            steps {
                script {
                    sh "kubectl config use-context my-aks-context"
                    sh "kubectl create deployment ${CONTAINER_NAME} --image=${REGISTRY}/${IMAGE_NAME}:${IMAGE_TAG}"
                    sh "kubectl scale deployment ${CONTAINER_NAME} --replicas=1"
                    sh "kubectl expose deployment ${CONTAINER_NAME} --port=3306 --type=ClusterIP"
                }
            }
        }
    }
}
