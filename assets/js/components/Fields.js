    // ./assets/js/components/Fields.js
    import React from 'react';
     
    const Fields = ({ id, name, type, constraints, clickDelete , index}) => {
        

        return (
            <div className="row">
                <div key={id} className="col-2">
                    <p>{index} ({id})</p>
                </div>
                <div className="col-4">
                    {name}
                </div>
                <div className="col-4">
                    {type} - {constraints}
                </div>
                <div className="col-2">
                    <a href="#" onClick={ () => clickDelete(index)}> Delete</a>
                </div>
            </div>
        );
    };
    
    export default Fields;