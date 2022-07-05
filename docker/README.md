# DOCKER <img src="https://img.shields.io/badge/Docker-3766AB?style=flat-square&logo=docker&logoColor=white"/></a>

## 명령어 
-------------------------------------------------------

## - docker run과 docker exec의 특징

1. run 
    - Docker에서 가장 중요한 명령어로 컨테이너를 생성하고 실행할 때 사용
    - 새로운 컨테이너 환경을 만듬
    - Docker를 사용해 관리할 수 있고, 표준출력와 표준에러의 내용을 확인할 수 있음
2. exec 
    - 이미 실행된 특정 컨테이너의 환경을 디버깅하는 용도로 사용
    - 컨테이너로 취급되지 않으며 로그 확인이나 프로세스 완료 여부를 알기가 더 어렵다

<br><br>
## 1. run - 컨테이너 실행

```
docker run [OPTIONS] IMAGE[:TAG|@DIGEST] [COMMAND] [ARG...]
            (<옵션>)     <이미지 식별자>      (<명령어>) (<인자>)
```

|COMMAND| Description |
|:---:|:---:|
|-d|detached mode (백그라운드 모드)|
|-p|호스트와 컨테이너의 포트를 연결|
|-v|호스트와 컨테이너의 디렉토리를 연결|
|-e|컨테이너 내에서 사용할 환경변수 설정|
|--name|컨테이너 이름 설정|
|--rm|프로세스 종료시 컨테이너 자동 제거|
|--it|-i와 -t를 동시에 사용한 것으로 터미널 입력을 위한 옵션|
|--network|네트워크 연결|

<br><br>

## 2. exec - 이미 실행된 특정 컨테이너의 환경을 디버깅하는 용도로 사용

```
docker exec <CONTAINER_ID> <COMMAND>
        (<컨테이너 ID or 이름>) (<명령어>) 
```

|COMMAND| Description | EX|
|:---:|:---:|---|
|--workdir|프로세스가 실행되는 위치를 변경할 수 있습니다.| $ docker exec -it --workdir /tmp ghost bash<br>bash-5.0# pwd<br>/tmp |
|-e or --end-file | 추가 환경변수를 지정 | $ docker exec -it -e ADDITIONAL_ENV=value ghost bash <br>bash-5.0# env | grep ADDITIONAL <br>ADDITIONAL_ENV=value|
|--priviledged|프로세스에 추가적인 권한을 부여| https://docs.docker.com/engine/reference/run/ <br> https://man7.org/linux/man-pages/man7/capabilities.7.html
|--user|프로세스를 실행하는 사용자를 지정||

<br><br>

## 3. ps - 프로세스 확인 명령어
<br>

### - 실행 중인 Docker Container 나열
```
docker ps
```
<br>

### - 중지된 Container를 포함해 실행 중인 Docker Container 나열 (-a 옵션)
```
docker ps -a
```

<br>

### - Docker Container ID 나열 (-q 옵션)
```
docker ps -aq
```
<br>

### - 중지된 컨테이너 나열
```
docker ps --filter "status=exited"
```
 
 `'--filter' 옵션 대신 '-f' 옵션을 사용할 수 있다. 해당 옵션은 특정 상태의 컨테이너를 나열한다는 의미이다. 필터 옵션은 여러 개를 같이 사용할 수 있다. 컨테이너의 상태는 다음과 같이 참고할 수 있다.`

 ------

- created <br>
: 생성된 이후로 한 번도 시작되지 않은 컨테이너. 따라서 리소스를 잡아먹지 않음

* running <br>
: created 상태에서 start 한 컨테이너.  프로세스가 컨테이너 실행되고 있음을 의미

* restarting <br>
: 컨테이너 재시작 중

* paused <br>
: 컨테이너 내 모든 프로세스 무기한 중지 중을 의미

* removing <br>
: 컨테이너 제거 중인 상태

* dead <br>
: 컨테이너를 제거하려 했지만 일부 리소스가 외부에서 사용되어 제거되지 않고 작동하지 않는 상태

<br>

>  docker ps | wc -l : 실행중인 프로세스 갯수 파악


<br>

## 4. stop - 실행중인 컨테이너 중지 명령어
```
docker stop [OPTIONS] CONTAINER [CONTAINER...]
             (<옵션>)   (<컨테이너 ID or name>)
```
`docker stop 986f80c324ae 2b6c2e1dbaf0 이런식으로 여러개 중지가능` 

|COMMAND| Default | Description |
|:---:|:---:|:---:|
|--time , -t|10|Seconds to wait for stop before killing it|

<br>

## 5. rm - 종료된 컨테이너를 완전히 제거하는 명령어
```
docker rm [OPTIONS] CONTAINER [CONTAINER...]
           (<옵션>)   (<컨테이너 ID or name>)
```
`docker rm 986f80c324ae 2b6c2e1dbaf0 이런식으로 여러개 중지가능`

|COMMAND| Description |
|:---:|:---:|
|-f|실행중인 컨테이너 강제 삭제|

<br>

> docker rm -f $(docker ps -aq) : 모든 컨테이너 전체삭제 (삭제되면 복구안되니 주의!!!!!)