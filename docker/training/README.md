# mariadb

## 1. docker maria image 가져오기

```
docker pull mariadb
```

## 2. docker  컨테이너 실행
```
docker  run -d -p 13306:3306 \
-e MYSQL_ROOT_PASSWORD=1234 \
--name mariadb \
mariadb


-- 중간에 -v /Users/diaz/database/mariadb:/var/lib/mysql \ 이 명령어를 넣어서 호스트와 컨테이너의 디렉토리를 연결 해줘도 됨. 그러면 로컬 PC에 mariadb관련 파일 생성됨
```

## 3. docker 컨테이너 접속

```
docker ps 확인 후 

CONTAINER ID  |  IMAGE   |  COMMAND                |  CREATED       |  STATUS       |  PORTS                   |  NAMES   |
2b6c2e1dbaf0  |  mariadb |  "docker-entrypoint.s…" |  9 seconds ago |  Up 9 seconds |  0.0.0.0:13306->3306/tcp |  mariadb |


접속할 CONTAINER ID와 IMAGE 작성 후, 

- mariadb로 바로 접속방법
1. docker exec -it 2b6c2e1dbaf0 mariadb mysql -u root -p

- mariadb가 설치되어 있는 서버로 접근하여 mariadb 접속 방법
1. docker exec -it 2b6c2e1dbaf0 /bin/bash
2. mysql -u root -p 엔터 후 비밀번호 입력
3. 접속 완료됨. 확인을 위해 show databases; 쳐봐도됨
```

## 4. 계정 생성 (도커 테스트를 위해 wp로 생성함)
```
create database wp CHARACTER SET utf8;
grant all privileges on wp.* to wp@'%' identified by 'wp';
flush privileges;
```
<br><br>

# 워드프레스 블로그 

## 1. 컨테이너 실행
```
docker run -d -p 8080:80 \
  -e WORDPRESS_DB_HOST=host.docker.internal:13306 \
  -e WORDPRESS_DB_NAME=wp \
  -e WORDPRESS_DB_USER=wp \
  -e WORDPRESS_DB_PASSWORD=wp \
  wordpress

  host.docker.internal docker를 띄워놓은 아이피로 접근함
```