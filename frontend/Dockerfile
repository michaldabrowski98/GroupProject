FROM node:18.16.0-alpine

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY ./app/package.json /app/package.json
RUN npm install
RUN npm install @vue/cli@3.7.0 -g
RUN cd /app && npm i vue@3.2.26

CMD ["npm", "run", "serve"]
