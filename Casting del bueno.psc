Algoritmo Casting
	Definir i, n Como Entero
	Definir m Como caracter
	cnum<-"0123456789"
	Escribir "¿Cuántas vocales va a ingresar"
	Leer m
	Para i<-1 Hasta longitud(m) Con Paso 1 Hacer
		Para j<-1 Hasta longitud(cnum) Con Paso 1 Hacer
			Si Subcadena(m,i,i)=Subcadena(cnum,j,j) Entonces
				EsNumero=Verdadero
			Fin Si
		Fin Para
	Fin Para
	Si EsNumero=Verdadero Entonces
		Escribir "Tiene vocales"
	SiNo
		Escribir "No tiene vocales "
	Fin Si
FinAlgoritmo
