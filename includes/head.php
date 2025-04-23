<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THETECMENS</title>
    <link href="/tienda-tecnologica/assets/css/style.css" rel="stylesheet" type="text/css">
</head>


<style>

/* ESTILOS DEL DESPLEGABLE POR QUE NO LOS PUDE LINKEAR */
.login__container {
    /* padding-top: 50px;
    margin-top: 50px; */
    position: relative;
    top: 50px;
    /* margin: 50px auto; */
}
.dropdown {
    position: relative;
    display: inline-block;
    gap: 2rem;
}
.dropdown-toggle {
    background-color: transparent ;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: white;
}
.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    height: auto;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 5px;
    color: black;
    gap: 10rem;
}
.dropdown-menu a {
    color: black;
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    margin-top: 10px;
    border-top: 1px solid #ccc; 
}
.dropdown-menu a:hover {
    background-color: gray;
}

.botones__catgoria{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 2rem;
}
.button__confirmation{
    color: white;
    background-color: green;
    padding: 1rem;
    border-radius: 1rem;
}

/* Agrega esto a tu archivo style.css */
.button-detalles {
    background: #4E5D6C;
    text-decoration: none;
    padding: 10px 15px;
    margin: 10px auto;
    border-radius: 5px;
    color: orange;
    font-weight: 700;
    display: block;
    width: 50%;
    text-align: center;
    transition: all 0.3s ease;
}

.button-detalles:hover {
    background-color: #364049;
    cursor: pointer;
    text-decoration: none;
    color: #f2f2f2;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
} 

.title-product{
    margin-top: 6rem;
}
</style>