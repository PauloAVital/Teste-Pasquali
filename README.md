# Teste-Desenvolvimento-Pasquali

---
## Subindo o Docker para rodar o app

1. **sudo docker-compose build app**

2. **sudo docker-compose up -d**

3. ![Título da imagem](public/img/rodar-docker.png)

---
## Instalar as dependências do composer

4. **sudo docker-compose exec app composer install**

5. ![Título da imagem](public/img/composer_install.png)

6. **sudo docker-compose exec app composer update**

6.1 Caso gere algum problema verifique se o .env está no projeto

---

## crie uma chave para o artisan

7. **sudo docker-compose exec app php artisan key:generate**

8. ![Título da imagem](public/img/key.png)
---

## Verifique se todos containers do Docker subiu

9. **sudo docker ps**

![Título da imagem](public/img/docker_ps.png)


---

10. Rode o Migrate **sudo docker-compose exec app php artisan migrate:refresh --seed**
![Título da imagem](public/img/migrate.png)
---

11. Acesse o **_http://localhost:8000/_**

---

12. Realize o login com o usuario ja criado:

    E-Mail Address: pauloavital@gmail.com

    Password: 123456789

13. ![Título da imagem](public/img/login.png)


10. Crie seu usuario e realize o login 
![Título da imagem](public/img/create.png)

---