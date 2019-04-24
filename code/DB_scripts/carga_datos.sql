BULK INSERT eq05.eq05.[Categorias]
   FROM 'e:\wwwroot\eq05\categorias.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[MetodosPago]
   FROM 'e:\wwwroot\eq05\metodosPago.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[Roles]
   FROM 'e:\wwwroot\eq05\roles.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[Usuarios]
   FROM 'e:\wwwroot\eq05\usuarios.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[Permisos]
   FROM 'e:\wwwroot\eq05\permisos.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[Productos]
   FROM 'e:\wwwroot\eq05\productos.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[Pagos]
   FROM 'e:\wwwroot\eq05\pagos.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[PermisosXRol]
   FROM 'e:\wwwroot\eq05\permisosxrol.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )

BULK INSERT eq05.eq05.[Compras]
   FROM 'e:\wwwroot\eq05\compras.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = ';'
      )