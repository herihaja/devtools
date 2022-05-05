/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/app.css';

// start the Stimulus application
import '../bootstrap';


import React from 'react';
import Fields from './components/Fields';
import ReactDOM from 'react-dom';
import { createRoot } from 'react-dom/client';
//import reportWebVitals from "./reportWebVitals";

 class Entity extends React.Component {
    constructor() {
        super();

        this.state = {
            entries: [],
            name: 'entity default',
            description: 'Lorem ipsum',
        };
    }

    componentDidMount = () => {
        //this.setState({entries: [{'id': 23, 'name':'id', 'type':'integer', 'constraints':'max=10'}]});
        //this.setState({entries: [["23",'id', 'integer', 'max=10']]});
        
        fetch('https://localhost:8000/entity-fields/')
            .then(response => response.json())
            .then(entries => {
                this.setState({
                    entries,
                });
            });
    }

    changeEntityName = (e) => {
        this.setState({name: e.target.value});
    }

    clickDeleteField = (id) => {
        this.setState({entries: this.state.entries.filter(item => item.id !== id)})
    }

    
    render () { 
        return (
            <div className="entity-container">
                <input type="text" value={this.state.name} onChange={this.changeEntityName} /> 
                <textarea name="description" defaultValue={this.state.description}></textarea>
                {this.state.entries.map(
                     ({ id, name, type, constraints }) => (
                        <Fields
                        key={id}
                        id={id}
                        name={name}
                        type={type}
                        constraints={constraints}
                        clickDelete={this.clickDeleteField}
                    >
                    </Fields>
                     )
                 )}
            </div>
        );
    }
    
}

//ReactDOM.render(<App />, document.getElementById('fields-list'));

const rootElement = document.getElementById("fields-list");
const root = createRoot(rootElement).render(<Entity />);
/*
ReactDOM.render(
    <App />, rootElement
);

/*
createRoot(
    document.getElementById('fields-list')
).render(
<App />
)

//reportWebVitals();*/