#!/bin/bash

rm -r service/files/report/*
cp -r app/src/assets service/files/report

mkdir service/files/report/templates
cp -r app/src/snippets/* service/files/report/templates

mkdir service/files/report/css
cp app/src/css/* service/files/report/css
docker-compose up --build