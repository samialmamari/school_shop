import { Link, Head , useForm} from '@inertiajs/react';

import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';

import TextInput from '@/Components/TextInput';
import { useState,  useEffect, useRef  } from 'react';


export default function Welcome() {
    const [nfcSupported, setNfcSupported] = useState(null);

    useEffect(() => {
      // Check if Web NFC API is supported
      if ('NDEFReader' in window) {
        setNfcSupported(true);
        startNfcScanning(); // Start scanning when NFC is supported
      } else {
        setNfcSupported(false);
      }
    }, []);
  
    const startNfcScanning = async () => {
      try {
        const reader = new NDEFReader();
        await reader.scan();
  
        reader.addEventListener('reading', (event) => {
          console.log('NFC tag read:', event.message.records);
          // Process NFC tag data here
        });
      } catch (error) {
        console.error('Error reading NFC:', error);
      }
    };
  
    return (
      <div>
        <h1>NFC Reader Web App</h1>
        {nfcSupported === true && (
          <p>Scanning NFC...</p>
        )}
        {nfcSupported === false && (
          <p>NFC not supported in this browser.</p>
        )}
      </div>
    );
  
}
