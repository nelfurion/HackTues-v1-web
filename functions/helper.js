/*Get previous element sibling.
	Works in legacy browsers too.*/
function previousElementSibling( elem ) {

    do {

        elem = elem.previousSibling;

    } while ( elem && elem.nodeType !== 1 );

    return elem;
}