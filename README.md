#General
This theme doesn't requiere any configuration. And doesn't have any dependencies
for specific Wordpress install.

This can be install on any existing or new Wordpress installation.



#Install WORDPRESS on NGINX 

 cd /var/www/html/wordpress/public_html

 wget https://wordpress.org/latest.tar.gz

 tar -zxvf latest.tar.gz

 mv wordpress/* .

 rm -rf wordpress

# Allow uploads permissions
sudo setfacl -Rm u:www-data:rwx wp-content/uploads

#Create DB on QA - install and enjoy 