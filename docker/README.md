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
## 1. run - 컨테이너 실행 (image가 없으면 자동으로 pull)

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

<br>

## 6. logs - 로그확인 명령어

```
docker logs [OPTIONS] CONTAINER
```
|COMMAND| Description |
|:---:|:---:|
|-tail [rows]|rows만큼 마지막 로그를 출력한다. 모든 로그를 출력하고싶다면 rows에 all을 입력하면 된다.|
|--timestamps|로그에 타임스탬프를 포함하여 출력한다.|
|--details|로그의 세부 정보를 함께 조회한다.|
|--follow, -f|로그를 일회성으로 출력하지 않고 계속해서 로그를 조회한다. 컨테이너에서 새로운 출력이 발생하면 추가로 로그 조회 명령어를 입력하지 않아도 로그를 볼 수 있다.|
|--since|특정 타임스탬프 이후 또는 상대시간 이후의 로그를 볼 수 있다|
<br>
### 마지막에 찍히는 10개의 로그만 보고 싶어 <br/>
- docker logs --tail 10 <CONTAINER>

### 지금부터 생성되는 로그도 보고 싶어
- docker logs -f <CONTAINER>

### 기존의 로그를 무시하고 새로 생성되는 로그만 보려면
- docker logs -f --tail 0 <CONTAINER>

### 특정 메세지가 들어간 로그만 보고 싶은데
- docker logs test | grep :20


<br>

## 7. images 명령어 - 설치된 image 확인

```
docker images [OPTIONS] [REPOSITORY[:TAG]]
```

|COMMAND| Description |
|:---:|:---:|
|-a|모든 이미지를 표시|
|--digests|digest 항목도 함께 표시|
|--no-trunc|모든 결과 표시|
|-q|Docker 이미지 id만을 표시|

<br>

## 8. pull 명령어 - image 다운로드
```
docker pull [OPTIONS] NAME[:TAG|@DIGEST]
```

태그명을 생략하면 기본적으로 가장 최신 버전(latest)을 다운로드한다. <br>
모든 태그의 이미지를 받기 위해서는 "-a" 옵션을 준다. 이 경우에는 태그명 지정을 할 수 없다.

docker pull 명령어에 이미지 URL을 지정할 수도 있는데, 이 때 http://는 생략한다.<br>
URL을 생략하면 로그인된 레파지토리에서 pull을 시도한다.<br>
URL을 지정하여 pull을 하는 방법은 예를 들어 docker pull registry.hub.docker.com/ubuntu:6 와 같이 사용한다.

<br>

## 9. rmi 명령어 - image를 삭제함
```
docker rmi [OPTIONS] IMAGE [IMAGE...]
```

이미지를 삭제하는 방법 입니다.<br>

images 명령어를 통해 얻는 이미지 목록에서 이미지 ID를 입력하면 삭제가 됩니다. <br>
단, 컨테이너가 실행중인 이미지는 삭제되지 않습니다.

<br>

## 10. network 명령어 - 가상 네트워크 생성

|COMMAND| Description |
|:---:|:---:|
|  connect    | 도커 컨테이너를 도커 네트워크에 연결시  |
|  create     | 도커 네트워크 생성                 |
|  disconnect | 연결된 도커 컨테이너 네트워크 연결 해제 |
|  inspect    | 도커 네트워크 상세 정보 확인         |
|  ls         | 네트워크의 구성 정보를 목록으로 확인   |
|  prune      | 사용하지 않는 모든 도커 네트워크 제거  |
|  rm         | 도커 네트워크 제거

### 가상 네트워크 생성 (create)
```
docker network create [OPTIONS] NETWORK
```
|OPTIONS| Description |
|:---:|:---:|
|       --attachable        |   Enable manual container attachment                     |
|      --aux-address map    |  Auxiliary IPv4 or IPv6 addresses used by Network driver (default map[])|
|      --config-from string |  The network from which copying the configuration|
|      --config-only        |  Create a configuration only network|
|  -d, --driver string      |  네트워크 관리하는 드라이브 (default "bridge")|
|      --gateway strings    |  IPv4 or IPv6 Gateway for the master subnet|
|      --ingress            |  Create swarm routing-mesh network|
|      --internal           |  Restrict external access to the network|
|      --ip-range strings   |  컨테이너에 IP 할당 범위|
|      --ipam-driver string |  IP Address Management Driver (default "default")|
|      --ipam-opt map       |  Set IPAM driver specific options (default map[])|
|      --ipv6               |  Enable IPv6 networking|
|      --label list         |  네트워크 메타 데이터 설정|
|  -o, --opt map            |  Set driver specific options (default map[])|
|      --scope string       |  Control the network's scope|
|      --subnet strings     |  CIDR형 네트워크 서브|


`네트워크의 종류 (default : bridge)`

- bridge :  네트워크는 하나의 호스트 컴퓨터 내에서 여러 컨테이너들이 서로 소통할 수 있도록 해줍니다. 
- host :  네트워크는 컨터이너를 호스트 컴퓨터와 동일한 네트워크에서 컨테이너를 돌리기 위해서 사용됩니다.
- overlay : 네트워크는 여러 호스트에 분산되어 돌아가는 컨테이너들 간에 네트워킹을 위해서 사용됩니다.

### 네트워크 연결
```
docker network connect [OPTIONS] [NETWORK NAME] [CONTAINER NAME]
```

|OPTIONS| Description |
|:---:|:---:|
|--alias strings         |  컨테이너에 네트워크 별칭 추가|
|--ip string             |  IPv4 설정|
|--ip6 string            |  IPv6 설정|
|--link list             |  다른 컨테이너에 링크 연결|
|--link-local-ip strings |  컨테이너에 링크 로컬 주소 추가|

### 네트워크 연결 해제
```
docker network disconnect [OPTIONS] [NETWORK NAME] [CONTAINER NAME]
```

### 네트워크 구성 정보 확인
```
docker network ls [OPTIONS]
```
|OPTIONS| Description |
|:---:|:---:|
|-f, --filter <필터> | 출력 필터|
|--format <문자열> | 문자 포맷|
|--no-trunc | 출력을 자르지 않는다.|
|-q, --quiet | 네트워크 ID만 출력한다.|

### network 상세정보 확인 (inspect)
```
docker network inspect [OPTIONS] NETWORK [NETWORK...]
```
|OPTIONS| Description |
|-f, --format string |  Format the output using the given Go template|
|-v, --verbose    |     Verbose output for diagnostics|

### network 삭제
```
docker network rm [NETWORK...]
```