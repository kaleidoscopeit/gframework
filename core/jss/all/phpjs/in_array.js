in_array=function (a,b,c){var d='',strict=!!c;if(strict){for(d in b){if(b[d]===a){return true}}}else{for(d in b){if(b[d]==a){return true}}}return false}