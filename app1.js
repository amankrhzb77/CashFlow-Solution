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
const contractABI =  [
	{
		"anonymous": false,
		"inputs": [
			{
				"indexed": true,
				"internalType": "address",
				"name": "from",
				"type": "address"
			},
			{
				"indexed": true,
				"internalType": "address",
				"name": "to",
				"type": "address"
			},
			{
				"indexed": false,
				"internalType": "uint256",
				"name": "amount",
				"type": "uint256"
			}
		],
		"name": "Transfer",
		"type": "event"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "",
				"type": "address"
			}
		],
		"name": "balances",
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
		"inputs": [],
		"name": "deposit",
		"outputs": [],
		"stateMutability": "payable",
		"type": "function"
	},
	{
		"inputs": [
			{
				"internalType": "address",
				"name": "to",
				"type": "address"
			},
			{
				"internalType": "uint256",
				"name": "amount",
				"type": "uint256"
			}
		],
		"name": "transfer",
		"outputs": [],
		"stateMutability": "nonpayable",
		"type": "function"
	}
 ];
const contractAddress = '0xf1a2f8CeEC0da3b032A031383c78F38bA1bC64BE'; // Replace with the actual contract address

// Create a contract instance
const contract = new web3.eth.Contract(contractABI, contractAddress);

// Function to submit the form data
async function submitForm() {
    try {
        // Get form data

		const recipientId = document.getElementById('reciever_id').value;
        const depositAmount = document.getElementById('deposit_amount').value;
       

        // Prompt the user to connect their Ethereum account
        const accounts = await web3.eth.requestAccounts();

        // Send transaction to the smart contract
        const result = await contract.methods.transfer(recipientId, depositAmount).send({
            from: accounts[0],
            gas: '3000000' // Adjust gas limit as needed
        });

        console.log('Transaction hash:', result.transactionHash);
        alert('Transaction successful! Transaction hash: ' + result.transactionHash);

        // Redirect or perform other actions after successful transaction
    } catch (error) {
        //console.error('Error submitting form:', error.message);
        alert('Error submitting form. Check the console for details.');
    }
}
