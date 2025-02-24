# [Bayesian Poker](https://es.wikipedia.org/wiki/Red_bayesiana)

## Estructura del Proyecto y Repositorio

El proyecto está basado en la arquitectura modelo vista controlador, por lo que la lógica del proyecto se separa en tres componentes `Modelos`, `Controladores`, y `Vistas`.
Se utliza el lenguaje de programación [PHP](https://en.wikipedia.org/wiki/PHP) ya que es un lenguaje que se adapta especialmente al desarrollo web.

### 📂 **Vistas**

> Aquí se gurdaran todas las **páginas html o peticiones de php a la base de datos** para después renderizar los resultados en html.

---

### 📂 **Controladores**

> Aquí se gurdaran todas las **peticiones que hace el usuario**, ej: Cambiar contraseña, enviar email de confirmación, votar, etc. **Este componente es el patrón de los otros dos 😎😎**, ya que recibe la información (es decir los datos, ej: info del usuario, info del proyecto) por parte del modelo y utiliza las vitas para mostrar esa información.

---

### 📂 **Modelos**

> En los modelos se crean **clases representativas de las entidades de la base de datos**, es decir si se tiene una tabla de usuarios, se tendrá una clase de usuarios para representar la entidad de la bd.

---

### 📜 **Archivos php**

> Los archivos php que están al principio del proyecto son solo links que llaman a controladores para hacer algo, la neta si se pasaron de rosca los del año pasado, pero que se le va hacer😑😑😑😑.
