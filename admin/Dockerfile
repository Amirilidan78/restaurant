FROM node:14.17.6-alpine3.11

WORKDIR /app/admin

COPY package.json ./

RUN npm i -f

COPY . .

ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

CMD [ "npm" ,"run" ,"dev" ]

