### etc/apache2/sites-availabe/default ###

```
Alias /mysvn "/home/sander/mysvn/www"
<Directory /home/sander/mysvn/www>
	Order allow,deny
	Allow from all

	RewriteEngine on
	RewriteBase /mysvn

	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteRule ^(.+)$ index.php/$1

	RewriteRule ^/?$ index.php/
</Directory>

<Location /mysvn>
	 AuthType Basic
	 AuthName "MySvn Authentication"
	 AuthUserFile /home/sander/mysvn/htpasswd
	 Require valid-user
</Location>

<Location /svn>
	DAV svn
	SVNParentPath /home/sander/mysvn/svn

	AuthType Basic
	AuthName "Subversion repository"
	AuthUserFile /home/sander/mysvn/htpasswd
	AuthzSVNAccessFile /home/sander/mysvn/authz

	Satisfy Any
	Require valid-user
</Location>

<Location /trac>
	SetHandler mod_python
	PythonInterpreter main_interpreter
	PythonHandler trac.web.modpython_frontend
	PythonOption TracEnvParentDir /home/sander/mysvn/trac
	PythonOption TracUriRoot /trac
	PythonOption PYTHON_EGG_CACHE /tmp
</Location>

<LocationMatch /trac/[^/]+/login>
	 AuthType Basic
	 AuthName "Trac Authentication"
	 AuthUserFile /home/sander/mysvn/htpasswd
	 Require valid-user
</LocationMatch>
```

### etc/apache2/mod-available/dav\_svn.conf ###

```
<Location /svn>

  DAV svn

  SVNParentPath /home/sander/mysvn/svn
 
  AuthType Basic
  AuthName "Subversion Repository"
  AuthUserFile /home/sander/mysvn/htpasswd

  AuthzSVNAccessFile /home/sander/mysvn/authz

</Location>

```

Add your content here.  Format your content with:
  * Text in **bold** or _italic_
  * Headings, paragraphs, and lists
  * Automatic links to other wiki pages