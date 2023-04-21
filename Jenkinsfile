pipeline {
    node('master') {

    def servicePrincipalId = '559fc471-900a-4d25-9acc-ee2b53dc4ffc'
    def resourceGroup = 'project2-msa-rg'
    def aks = 'project2-msa-rg'

    def dockerRegistry = 'project2-msa-rg.azurecr.io'
    def imageName = "mysql:${env.BUILD_NUMBER}"
    env.IMAGE_TAG = "${dockerRegistry}/${imageName}"
    def dockerCredentialId = 'd0xHO7oarmxe7rbT04pFoDPfe3po1pyMy8SHIBqyEL+ACRD65WyR'

    def currentEnvironment = 'blue'
    def newEnvironment = { ->
        currentEnvironment == 'blue' ? 'green' : 'blue'
    }
    stage('SCM') {
        checkout scm
    }
    stage('Build') {
        withCredentials([azureServicePrincipal(servicePrincipalId)]) {
            sh """
                az login --service-principal -u "\$AZURE_CLIENT_ID" -p "\$AZURE_CLIENT_SECRET" -t "\$AZURE_TENANT_ID"
                az account set --subscription "\$AZURE_SUBSCRIPTION_ID"

                sh ./mvnw clean package
                az logout
            """
        }
    }
    stage('Docker Image') {
        withDockerRegistry([credentialsId: dockerCredentialId, url: "http://${dockerRegistry}"]) {
            dir('target') {
                sh """
                    cp -f ../src/aks/Dockerfile .
                    docker build -t "${env.IMAGE_TAG}" .
                    docker push "${env.IMAGE_TAG}"
                """
            }
        }
    }
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

    
    pipeline {
    agent any
    environment {
        ACR_NAME = 'cicd2project' // Azure ACR 이름으로 변경
        IMAGE_NAME = 'mysql' // 변경하지 않아도 됩니다.
        NEW_IMAGE_TAG = '8.0' // 변경할 이미지 태그
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Build and Push Image') {
            steps {
                script {
                    docker.build("${ACR_NAME}.azurecr.io/${IMAGE_NAME}:${NEW_IMAGE_TAG}", ".")
                    docker.withRegistry("https://${ACR_NAME}.azurecr.io", 'acr') {
                        docker.image("${ACR_NAME}.azurecr.io/${IMAGE_NAME}:${NEW_IMAGE_TAG}").push()
                    }
                }
            }
        }
        stage('Deploy') {
            steps {
                sh 'terraform init'
                sh 'terraform apply'
            }
        }
    }
}
