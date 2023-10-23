FROM nginx:latest

ARG TERM=linux
ARG DEBIAN_FRONTEND=noninteractive

RUN apt update
RUN apt install -y util-linux
RUN apt install -y \
    iputils-ping \
    mc \
    mlocate \
    nano

EXPOSE 80