# DOCKER <img src="https://img.shields.io/badge/Docker-3766AB?style=flat-square&logo=docker&logoColor=white"/></a>



## 기본 명령어 

### run - 컨테이너 실행


```
docker run [OPTIONS] IMAGE[:TAG|@DIGEST] [COMMAND] [ARG...]
            (<옵션>)     <이미지 식별자>      (<명령어>) (<인자>)
```

|COMMAND| Explanation |
|:---:|:---:|
|-d|detached mode (백그라운드 모드)|
|-p|호스트와 컨테이너의 포트를 연결|
|-v|호스트와 컨테이너의 디렉토리를 연결|
|-e|컨테이너 내에서 사용할 환경변수 설정|
|--name|컨테이너 이름 설정|
|--rm|프로세스 종료시 컨테이너 자동 제거|
|--it|-i와 -t를 동시에 사용한 것으로 터미널 입력을 위한 옵션|
|--network|네트워크 연결|

### exec 명령어

```
docker exec <CONTAINER_ID> <COMMAND>
        (<컨테이너 ID or 이름>) (<명령어>) 
```

|COMMAND| Explanation | EX|
|:---:|:---:|---|
|--workdir|프로세스가 실행되는 위치를 변경할 수 있습니다.| $ docker exec -it --workdir /tmp ghost bash<br>bash-5.0# pwd<br>/tmp |
|-e or --end-file | 추가 환경변수를 지정 | $ docker exec -it -e ADDITIONAL_ENV=value ghost bash <br>bash-5.0# env | grep ADDITIONAL <br>ADDITIONAL_ENV=value|
|--priviledged|프로세스에 추가적인 권한을 부여| https://docs.docker.com/engine/reference/run/ <br> https://man7.org/linux/man-pages/man7/capabilities.7.html
|--user|프로세스를 실행하는 사용자를 지정||
