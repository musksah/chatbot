import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import PropTypes from 'prop-types';
import ChatBot from 'react-simple-chatbot';

class Review extends Component {
  constructor(props) {
    super(props);

    this.state = {
      name: '',
      gender: '',
      age: '',
    };
  }

  componentWillMount() {
    const { steps } = this.props;
    const { name, gender, age } = steps;

    this.setState({ name, gender, age });
  }

  render() {
    const { name, gender, age } = this.state;
    return (
      <div style={{ width: '100%' }}>
        <h3>Summary</h3>
        <table>
          <tbody>
            <tr>
              <td>Name</td>
              <td>{name.value}</td>
            </tr>
            <tr>
              <td>Gender</td>
              <td>{gender.value}</td>
            </tr>
            <tr>
              <td>Age</td>
              <td>{age.value}</td>
            </tr>
          </tbody>
        </table>
      </div>
    );
  }
}

Review.propTypes = {
  steps: PropTypes.object,
};

Review.defaultProps = {
  steps: undefined,
};

class SimpleForm extends Component {
  render() {
    return (
        <ChatBot
        steps={[
          {
            id: '1',
            message: 'Hello, How can I help you?',
            trigger: '2',
          },
          {
            id: '2',
            user: true,
            validator: (value) => {
              if (isNaN(value)) {
                return 'value should be a number';
              }
              return true;
            },
            trigger: '1',
          },
        ]}
      />
    );
  }
}

export default SimpleForm;

if (document.getElementById('simpleform')) {
    ReactDOM.render(<SimpleForm />, document.getElementById('simpleform'));
}