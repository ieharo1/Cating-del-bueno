Algoritmo Casting
	Definir suma, x, aux Como Real
	Definir i, n Como Entero
	Definir m Como caracter
	cnum<-"AEIOU"
	cnum<-"aeiou"
	Escribir "¿Cuántos números va a ingresar"
	Leer m
	Para i<-1 Hasta longitud(m) Con Paso 1 Hacer
		Para j<-1 Hasta 10 Con Paso 1 Hacer
			Si Subcadena(m,i,i)=Subcadena(cnum,j,j) Entonces
				EsNumero=Verdadero
			Fin Si
		Fin Para
	Fin Para
	Si EsNumero=Verdadero Entonces
		Escribir "Es Número"
	SiNo
		Escribir "El dato ingresado no es válido"
	Fin Si
FinAlgoritmo
