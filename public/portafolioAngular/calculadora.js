'use strict'

var params = process.argv.slice(2); //toma los parametros enviados de la consola d.o.s. y los guarda en la variable como array

var numero1 = parseFloat(params[0]);
var numero2 = parseFloat(params[1]);

/*en javascrip se pone estas comillas ` para la interpolacion de variables*/
var plantilla = `
La suma es: ${numero1 + numero2}
La resta es: ${numero1 - numero2}
La multiplicación: ${numero1 * numero2}
La división: ${numero1 / numero2}
`;

console.log(plantilla);