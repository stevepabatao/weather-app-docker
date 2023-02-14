FROM nginx:1.19.2-alpine

# Create the user and group
RUN addgroup -S -g 1000 www && adduser -S -D -u 1000 -G www www

# Create workdir
RUN mkdir -p /srv/html
RUN mkdir -p /srv/certs

# Copy Certificates
COPY ./certs /srv/certs
RUN chmod 0400 /srv/certs

COPY setup.sh /
RUN chmod +x /setup.sh

# Set directory ownership
RUN chown www:www /srv/html -R

ENTRYPOINT ["/setup.sh"]
CMD ["nginx", "-g", "daemon off;"]

WORKDIR /srv/html