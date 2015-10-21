#CMS#

##Feature##
###1.SlimFramework###
###2.Angular###
###3.AdminLte###


###Requirment###
nodejs & npm
```
# Using Ubuntu
curl -sL https://deb.nodesource.com/setup_4.x | sudo -E bash -
sudo apt-get install -y nodejs

```

yeoman
```
npm install -g yo
```
grunt
```
npm install -g grunt-cli
```


###Install###
Clone Repository
```
git clone git@github.com:muhamadsyahril/cms-angular-slim.git
```
Migrate database
```
bin/phpmig migrate

```

Create Entity

```
sudo yo angular-slim:entity [entityname]

```
