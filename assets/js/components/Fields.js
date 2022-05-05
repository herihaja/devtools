    // ./assets/js/components/Fields.js
    import React from 'react';
     
    const Fields = ({ id, name, type, constraints, clickDelete }) => {
        /*const clickDelete = (id) => {
            console.log(id, "from child");
        }*/

        return (
            <div className="row">
                <div key={id} className="col-2">
                    <p>{id}</p>
                </div>
                <div className="col-4">
                    {name}
                </div>
                <div className="col-4">
                    {type}
                </div>
                <div className="col-2">
                    <a href="#" onClick={ () => clickDelete(id)}> Delete</a>
                </div>
            </div>
        );
    };
    
    export default Fields;