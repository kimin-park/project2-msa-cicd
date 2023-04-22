pipeline {
    agent any

    environment {
        AZURE_STORAGE_ACCOUNT_NAME = "f5da8435a4b8647d9b78ffa"
        AZURE_STORAGE_ACCOUNT_KEY = "+ktswd5CF9LEkhE0RH7phQb79+uJdPw2vtH+jOFqUkmputSOf91iLd8b/0JLB/oBBFarPC4JP+uk+AStJvpfKw=="
        FILE_SHARE_NAME = "pvc-8853511a-018d-42b6-b984-dbe35552b16c"
        FILE_DIRECTORY = "./"
        FILE_NAME = "index.php"
    }

    stages {
        stage('git clone') {
            steps() {
              git 'https://github.com/kimin-park/project2-msa-cicd.git'
            }
        }
        stage('Upload file to Azure Storage file share') {
            steps {
                withAzureFileCopy(credentialsType: 'storageAccountConnectionString',
                                  storageAccountConnectionString: "DefaultEndpointsProtocol=https;AccountName=${AZURE_STORAGE_ACCOUNT_NAME};AccountKey=${AZURE_STORAGE_ACCOUNT_KEY};EndpointSuffix=core.windows.net",
                                  sourcePath: "${FILE_NAME}",
                                  fileShareName: "${FILE_SHARE_NAME}",
                                  targetPath: "${FILE_DIRECTORY}/${FILE_NAME}") {
                    sh 'echo "File uploaded successfully!"'
                }
            }
        }
    }
}
