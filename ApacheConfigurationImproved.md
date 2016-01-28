  * Install auth-mysql-mod
  * Add auth\_mysql.conf with 'Auth\_MySQL\_Info localhost root root'
  * Configure apache conf

```
<Location /mysvn>
	AuthBasicAuthoritative Off
	AuthMYSQL on
	AuthMySQL_Authoritative on
	AuthMySQL_DB mysvn
 AuthMySQL_Group_Table mysql_auth_groups
	AuthMySQL_Empty_Passwords off

	AuthType Basic
	AuthName "MySvn Authentication"
	Require group SVN_ADMIN
</Location>

<Location /svn>
	AuthBasicAuthoritative Off
	AuthMYSQL on
	AuthMySQL_Authoritative on
	AuthMySQL_DB mysvn
 AuthMySQL_Group_Table mysql_auth_groups
	AuthMySQL_Empty_Passwords off

	DAV svn
	SVNParentPath /home/sander/mysvn/svn

	AuthType Basic
	AuthName "Subversion repository"
	#AuthUserFile /home/sander/mysvn/htpasswd
	#AuthzSVNAccessFile /home/sander/mysvn/authz

	#Satisfy Any
	Require group SVN
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
	AuthBasicAuthoritative Off
	AuthMYSQL on
	AuthMySQL_Authoritative on
	AuthMySQL_DB mysvn
 AuthMySQL_Group_Table mysql_auth_groups
	AuthMySQL_Empty_Passwords off
	AuthType Basic
	AuthName "Trac Authentication"
	#AuthUserFile /home/sander/mysvn/htpasswd
	Require group TRAC_ADMIN
</LocationMatch>
```