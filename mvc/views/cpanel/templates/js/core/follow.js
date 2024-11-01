function loadRenderFollow( id , html ) {
    $$('.btn-follower').forEach(( element ) => {
        const idValue = parseInt( GetDataElement.get( element, 'data-id' ) );
        if ( idValue == id )
        {
            element.innerHTML = DOMPurify.sanitize( html, { RETURN_TRUSTED_TYPE: true } );
        }
    })   
}

function actionFllows() {
if ( $$('.btn-follower') ) 
{
    $$('.btn-follower').forEach(( element ) => 
    {
        element.addEventListener('click', () => 
        {
            const idValue = parseInt( GetDataElement.get( element, 'data-id' ) );
            const data = {
                'idonswer' : idValue,
                'class' : 'follower' 
            }
            CallAjax.send('POST', data, 'talk/mvc/core/HandleActionInteract.php', function( response ) 
            { 
                const dataJson = CallAjax.get( response, 'off' ).err_mess;
                try {
                    let render = '';
                    if ( dataJson.result ) 
                    {
                        if ( dataJson.result === 'yes' ) 
                        {
                            render = `<i class="fa-regular fa-circle-check"></i> <span> Đã theo dõi</span>`;
                        } else {
                            render = `<span>+ Theo dõi</span>`;
                        }
                        loadRenderFollow( idValue , render );
                        console.log( idValue, render );
                    }        
                }  
                catch ( err ) { console.error( err ) }
            })
        });
    });
}
}

const ActionFollowUses = {
    action: () => {
        actionFllows();
    }
}

ActionFollowUses.action();