import Web3 from "web3";
import Web3Modal from "web3modal";
import WalletConnectProvider from "@walletconnect/web3-provider";

// Web3modal instance
let web3Modal

// Chosen wallet provider given by the dialog window
let provider;

// Address of the selected account
let selectedAccount;

//jbac token
let contract = null;

/**
 * Setup the orchestra
 */
function init()
{
    const providerOptions = {
        walletconnect: {
            package: WalletConnectProvider,
            options: {
                infuraId: "1349df420b63b02a7763771024da262d",
            }
        },
    };

    web3Modal = new Web3Modal({
        cacheProvider: false, // optional
        providerOptions, // required
        disableInjectedProvider: false, // optional. For MetaMask / Brave / Opera.
        theme: "dark",
        network: "mainnet",
    });
}


/**
 * Kick in the UI action after Web3modal dialog has chosen a provider
 */
async function fetchAccountData()
{
    // Get a Web3 instance for the wallet
    const web3 = new Web3(provider);

    // Get list of accounts of the connected wallet
    const accounts = await web3.eth.getAccounts();

    //Launch JBAC token
    contract = new web3.eth.Contract(window.abi, window.address);

    // MetaMask does not give you all accounts, only the selected account
    selectedAccount = accounts[0];
}

async function refreshAccountData() {
    await fetchAccountData(provider);
}

/**
 * Connect wallet button pressed.
 */
 async function onConnect()
 {
     try {
         provider = await web3Modal.connect();
     } catch(e) {
         console.log("Could not get a wallet connection", e);
         return;
     }

     // Subscribe to accounts change
     provider.on("accountsChanged", (accounts) => {
         fetchAccountData();
     });

     // Subscribe to chainId change
     provider.on("chainChanged", (chainId) => {
         fetchAccountData();
     });

     // Subscribe to networkId change
     provider.on("networkChanged", (networkId) => {
         fetchAccountData();
     });

     await refreshAccountData();

     let request = axios.post('/login', {'wallet': selectedAccount})

     return request.then(function (response) {
         window.location.reload();
     }).catch(function (error) {
         if (error.response) {
             window.helpers.alertErrors(error.response.data.errors)
         } else if (error.request) {
             console.error(error.request)
         } else {
             console.error('Error', error.message)
         }
     })
 }

/**
 * Main entry point.
 */
 window.addEventListener('load', async () => {
    init();

    let walletButton = document.querySelector("#wallet-connect");
    if(null !== walletButton){
        walletButton.addEventListener("click", onConnect);
    }
});

/**
 * Connect wallet button pressed.
 */
 async function onConnectWallet()
 {
     try {
         provider = await web3Modal.connect();
     } catch(e) {
         console.log("Could not get a wallet connection", e);
         return;
     }

     // Subscribe to accounts change
     provider.on("accountsChanged", (accounts) => {
         fetchAccountData();
     });

     // Subscribe to chainId change
     provider.on("chainChanged", (chainId) => {
         fetchAccountData();
     });

     // Subscribe to networkId change
     provider.on("networkChanged", (networkId) => {
         fetchAccountData();
     });

     await refreshAccountData();
     let walletBtn = document.querySelector("#wallet");
     document.querySelector("#wallet-address").value = selectedAccount;
     document.querySelector("#wallet-view").value = selectedAccount;
     document.querySelector("#btnPurchase").removeAttribute("disabled");
     walletBtn.setAttribute("disabled", "");
     walletBtn.innerHTML = "Connected!";
 }

/**
 * Main entry point.
 */
 window.addEventListener('load', async () => {
    init();

    let walletButton = document.querySelector("#wallet");
    if(null !== walletButton){
        walletButton.addEventListener("click", onConnectWallet);
    }
});


/**
 * Connect wallet button pressed.
 */
 async function onConnectWalletBuyTokenSubmit()
 {
     try {
         provider = await web3Modal.connect();
     } catch(e) {
         console.log("Could not get a wallet connection", e);
         return;
     }

     // Subscribe to accounts change
     provider.on("accountsChanged", (accounts) => {
         fetchAccountData();
     });

     // Subscribe to chainId change
     provider.on("chainChanged", (chainId) => {
         fetchAccountData();
     });

     // Subscribe to networkId change
     provider.on("networkChanged", (networkId) => {
         fetchAccountData();
     });

     await refreshAccountData();

     alert('Do your thing');
 }

/**
 * Main entry point.
 */
 window.addEventListener('load', async () => {
    init();

    let walletButton = document.querySelector("#wallet-buy-token-submit");
    if(null !== walletButton){
        walletButton.addEventListener("click", onConnectWalletBuyTokenSubmit);
    }
});
