// Connect to MetaMask provider
const web3 = new Web3(window.ethereum);

// Ensure MetaMask is connected
async function checkMetaMask() {
    if (typeof window.ethereum !== 'undefined') {
        try {
            await window.ethereum.enable();
            console.log('MetaMask is connected');
        } catch (error) {
            console.error('User denied account access');
        }
    } else {
        console.error('MetaMask is not installed');
    }
}

// Check MetaMask connection
checkMetaMask();

// Smart contract ABI and address
// (Replace with your contract's ABI and address)
const contractABI = [
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "studentAddress",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "name",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "roll_no",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "password",
				"type": "string"
			},
			{
				"indexed": false,
				"internalType": "string",
				"name": "branch",
				"type": "string"
			}
		],
		"name": "StudentAdded",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "string",
				"name": "name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "roll_no",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "password",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "branch",
				"type": "string"
			}
		],
		"name": "addStudent",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "index",
				"type": "uint256"
			}
		],
		"name": "getStudentByIndex",
		"outputs": [
			{
				"internalType": "string",
				"name": "name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "roll_no",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "password",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "branch",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [],
		"name": "getStudentCount",
		"outputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "uint256",
				"name": "",
				"type": "uint256"
			}
		],
		"name": "studentAddresses",
		"outputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"stateMutability": "view",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"name": "students",
		"outputs": [
			{
				"internalType": "string",
				"name": "name",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "roll_no",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "email",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "password",
				"type": "string"
			},
			{
				"internalType": "string",
				"name": "branch",
				"type": "string"
			}
		],
		"stateMutability": "view",
		"type": "function"
	}
];
const contractAddress = '0xd9145CCE52D386f254917e481eB44e9943F39138';

// Create a contract instance
const contract = new web3.eth.Contract(contractABI, contractAddress);

// Function to submit the form data
// Function to submit the form data and update table
async function submitForm() {
    try {
        // Get form data
        const name = document.getElementById('name').value;
        const roll_no = document.getElementById('roll_no').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const branch = document.getElementById('branch').value;
        

        // Prompt the user to connect their Ethereum account
        const accounts = await web3.eth.requestAccounts();

        // Send transaction to the smart contract
        const result = await contract.methods.addStudent(name, roll_no, email,password,branch).send({
            from: accounts[0],
            gas: '3000000' // Adjust gas limit as needed
        });

        console.log('Transaction hash:', result.transactionHash);
        alert('Transaction successful! Transaction hash: ' + result.transactionHash);
        
        // After transaction, fetch data and update table
        //await displayStudentData();
    } catch (error) {
        console.error('Error submitting form:', error.message);
        alert('Error submitting form. Check the console for details.');
    }
}

