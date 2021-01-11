import React, { useEffect, useState, useContext } from 'react';
import ReactDOM from 'react-dom';

function Example() {
    const [value, setValue] = useState('');
    useEffect(() => {
        getInfoChat();
    }, []);

    const getInfoChat = () => {
        axios.get(`${URL}/${id}`).then(
            res => {

            }
        )
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>
                        <div className="card-body">I'm an example component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}
export default Example;

