#!/bin/bash

echo ""
set -a
source ../.env
echo $DOCKER_PROJECT_NAME

BOLD="$(tput bold)"
RED="$(tput setaf 1)"
GREEN="$(tput setaf 2)"
YELLOW="$(tput setaf 3)"
BLUE="$(tput setaf 4)"
RESET="$(tput sgr0)"

cd docker
docker compose pull
docker compose -p ${DOCKER_PROJECT_NAME} up -d
cd ../
echo ""
sleep 10
echo -e "Configuring project: "

echo -e "${BOLD}${RED}---------${RESET}"
echo -e "docker exec -it ${DOCKER_PROJECT_NAME}_php composer install"
docker exec -it ${DOCKER_PROJECT_NAME}_php composer install

echo -e "${BOLD}${RED}---------${RESET}"
echo -e "docker network connect ${DOCKER_NETWORK} ${DOCKER_PROJECT_NAME}_php"
docker network connect ${DOCKER_NETWORK} ${DOCKER_PROJECT_NAME}_php

echo -e "${BOLD}${RED}---------${RESET}"
echo -e "docker network connect ${DOCKER_NETWORK} ${DOCKER_PROJECT_NAME}_mysql"
docker network connect ${DOCKER_NETWORK} ${DOCKER_PROJECT_NAME}_mysql

echo "${BOLD}${RED}--------------------------------------------------------------------------------${RESET}"
echo "${YELLOW}Server DB: ${BOLD}${GREEN}${DOCKER_IP}:${DOCKER_PORT_DB}${RESET}"
echo "${YELLOW}App IP: ${BOLD}${GREEN}${DOCKER_IP}:${DOCKER_PORT_HTTP}${RESET}"
echo "${BOLD}${RED}--------------------------------------------------------------------------------${RESET}"
echo ""

read -n 1 -s -r -p "Press enter to continue..."
