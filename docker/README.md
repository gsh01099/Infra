# DOCKER <img src="https://img.shields.io/badge/Docker-3766AB?style=flat-square&logo=docker&logoColor=white"/></a>



## run - 컨테이너 실행

```
docker run [OPTIONS] IMAGE[:TAG|@DIGEST] [COMMAND] [ARG...]
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

