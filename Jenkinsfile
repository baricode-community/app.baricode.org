pipeline {
    agent any

    environment {
        ZIP_NAME = 'public_build.zip'
        REMOTE_USER = 'barizaloka'
        REMOTE_HOST = '103.138.189.213'
        REMOTE_PATH = '/home/barizaloka/app.baricode.org/public/build'
        APP_PATH = '/home/barizaloka/app.baricode.org'
    }

    stages {
        stage('Install PHP Dependencies') {
            steps {
                echo '📦 Instalasi Composer dependencies...'
                sh '''
                    docker run --rm \
                        -v "$(pwd):/app" \
                        -w /app \
                        composer:latest \
                        php:8.4-cli \
                        composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs
                '''
            }
        }

        stage('Install Node & Build Assets') {
            steps {
                echo '🎨 Instalasi Node dependencies & build assets...'
                sh '''
                    docker run --rm \
                        -v "$(pwd):/app" \
                        -w /app \
                        node:20-alpine \
                        sh -c "npm ci && npm run build"
                '''
            }
        }

        stage('Zip public/build') {
            steps {
                echo '📦 Membuat zip dari public/build...'
                sh '''
                    cd public/build
                    zip -r "$(pwd)/../../${ZIP_NAME}" .
                    cd ../..
                '''
            }
        }

        stage('Deploy public/build ke cPanel') {
            steps {
                echo '🚀 Mengirim zip ke server cPanel...'
                withCredentials([usernamePassword(
                    credentialsId: 'cpanel-ssh-barizaloka',
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" scp -o StrictHostKeyChecking=no \
                            ${ZIP_NAME} ${SSH_USER}@${REMOTE_HOST}:${REMOTE_PATH}
                    '''
                }
            }
        }

        stage('Extract public/build di cPanel') {
            steps {
                echo '📂 Ekstrak zip public/build di server...'
                withCredentials([usernamePassword(
                    credentialsId: 'cpanel-ssh-barizaloka',
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no \
                            ${SSH_USER}@${REMOTE_HOST} "
                                rm -rf ${REMOTE_PATH}/* &&
                                unzip -o ${REMOTE_PATH}/${ZIP_NAME} -d ${REMOTE_PATH} &&
                                rm -f ${REMOTE_PATH}/${ZIP_NAME}
                            "
                    '''
                }
            }
        }

        stage('Git Pull di cPanel') {
            steps {
                echo '🔄 Menjalankan git pull di cPanel...'
                withCredentials([usernamePassword(
                    credentialsId: 'cpanel-ssh-barizaloka',
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no \
                            ${SSH_USER}@${REMOTE_HOST} "
                                cd ${APP_PATH} &&
                                git pull origin master
                            "
                    '''
                }
            }
        }

        stage('PHP Artisan Migrate') {
            steps {
                echo '🗄️ Menjalankan migrasi database...'
                withCredentials([usernamePassword(
                    credentialsId: 'cpanel-ssh-barizaloka',
                    usernameVariable: 'SSH_USER',
                    passwordVariable: 'SSH_PASS'
                )]) {
                    sh '''
                        sshpass -p "$SSH_PASS" ssh -o StrictHostKeyChecking=no \
                            ${SSH_USER}@${REMOTE_HOST} "
                                cd ${APP_PATH} &&
                                php artisan migrate
                            "
                    '''
                }
            }
        }

        stage('Hapus Zip Lokal') {
            steps {
                echo '🗑️ Membersihkan zip di workspace Jenkins...'
                sh 'rm -f ${ZIP_NAME}'
            }
        }
    }

    post {
        success { echo '✅ Deploy baricode.org berhasil!' }
        failure { echo '❌ Deploy gagal, cek log di atas!' }
    }
}
