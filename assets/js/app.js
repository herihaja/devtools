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


import React, {StrictMode} from 'react';
import Fields from './components/Fields';
import { createRoot } from 'react-dom/client';
import { Modal, Button, Form } from "react-bootstrap";
import Select from "react-select";
import "bootstrap/dist/css/bootstrap.css";


 class Entity extends React.Component {
    constructor() {
        super();

        this.state = {
            entries: [],
            entityName: 'entity default',
            description: 'Lorem ipsum',
            showAddField: false,
            editedField: {'name': 'akondro', 'type': {'value': 'date', 'label':  'Date'}, 'id':0, 'constraints': 'max=100'}
        };
    }

    componentDidMount = () => {
        fetch('https://localhost:8000/entity-fields/')
            .then(response => response.json())
            .then(entries => {
                this.setState({
                    entries,
                });
            });
    }

    changeEntityName = (e) => {
        this.setState({entityName: e.target.value});
    }

    clickDeleteField = (id) => {
        var entries = this.state.entries;
        entries.splice(id, 1);
        this.setState({entries: entries});
    }

    addField = () => {
        if (!this.state.showAddField)
        this.setState({showAddField: true});
        else
        this.setState({showAddField: false});
    }

    closeFieldModal = () => {
        this.setState({showAddField: false});
    }

    updateEditedFieldType = (selected) => {
        var editedField = this.state.editedField;
        editedField.type = selected;
        this.setState(editedField);
    }

    updateEditedFieldName = (e) => {
        var editedField = this.state.editedField;
        editedField.name = e.target.value;
        this.setState({'editedField': editedField});
    }

    fieldTypeOptions = [
        {'value':'text', 'label': 'Text'}, 
        {'value':'number', 'label': 'Number'}, 
        {'value':'date', 'label': 'Date'}, 
        {'value':'relation', 'label':'Relation'},
    ];

    saveFieldForm = () => {
        var entries = this.state.entries; 
        var edited = JSON.parse(JSON.stringify(this.state.editedField));
        entries.push(edited);
        this.setState({'entries': entries, 'showAddField': false})
    }

    
    render () { 
        return (
            <div className="entity-container">
                <input type="button" onClick={this.addField} value="Add field"/>
                <input type="text" value={this.state.entityName} onChange={this.changeEntityName} /> 
                <textarea name="description" defaultValue={this.state.description}></textarea>

                {this.state.entries.map(
                     ({ id, name, type, constraints }, index) => (
                        <Fields
                        key={index+1}
                        index={index+1}
                        id={id}
                        name={name}
                        type={type.value}
                        constraints={constraints}
                        clickDelete={this.clickDeleteField}
                    >
                    </Fields>
                     )
                 )}
                <StrictMode>
                <Modal show={this.state.showAddField} animation={true} onHide={this.closeFieldModal} backdrop="static">

                    <Modal.Header closeButton>
                        <Modal.Title>Field Form</Modal.Title>
                    </Modal.Header>
            
                    <Modal.Body>
                        <label>Name: </label><input type="text" value={this.state.editedField.name}  onChange={this.updateEditedFieldName}/> 
                        <br/>
                        <label>Type: </label>
                        <Select defaultValue={this.state.editedField.type} value={this.state.editedField.type} onChange={this.updateEditedFieldType} options={this.fieldTypeOptions}>
                        </Select>
                        
                    </Modal.Body>
            
                    <Modal.Footer>
                        <Button variant="secondary" onClick={this.saveFieldForm}>Secondary</Button>
                        <Button variant="primary" onClick={this.saveFieldForm}>Primary</Button>
                    </Modal.Footer>
            
                </Modal>
                </StrictMode>
            </div>
        );
    }
    
}

const rootElement = document.getElementById("fields-list");
createRoot(rootElement).render(<Entity />);
