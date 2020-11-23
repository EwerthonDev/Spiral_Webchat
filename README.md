# Bem Vindos Ao Spiral Webchat!


<div style="text-align:center"><img src="https://www.flaticon.com/svg/static/icons/svg/137/137099.svg" height="400px" width="400px"/></div>


Este é um projeto voltado ao aprendizado, se trata de um webchat que será feito com: 
- **Laravel 8**
- **Vue.js**
- **Vuex**
- **Laravel WebSockets**
- **Laravel Echo**
- **TailwindCSS**

### Vídeo demonstrativo a baixo

https://streamable.com/mo4nq5

Pode acompanhar o projeto e inclusive contribuir para o mesmo!

## Como rodar o sistema? (em breve)

1 - rodar o composer install

2 - rodar o npm install

3 - rodar o npm run dev

4 - renomear o arquivo .env.example para somente .env

5 - dentro do arquivo .env localizar a conexão mysql e conectar com suas informações locais

6 - ainda dentro do arquivo .env adicionar nas configurações do pusher: 
PUSHER_APP_ID=myId
PUSHER_APP_KEY=myKey
PUSHER_APP_SECRET=mySecrect
PUSHER_APP_CLUSTER=mt1

7 - rodar o php artisan migrate

8 - rodar php artisan key:generate

9 - rodar o npm run dev novamente

10 - rodar o php artisan websockets:serve

11 - acessar /laravel-websockets em outra aba

12 - na aba do websocket clique em "conectar" 

13 - aproveite a experiência de tempo real!

(Caso receba vários erros no console do navegador, basta rodar novamente o php artisan serve, npm run watch e php artisan websocket:serve, dê um F5 na aba do websocket, conecta novamente o websocket e dê um F5 na aplicação!)
