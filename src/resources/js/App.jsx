import { useEffect, useState } from "react";

export default function App(){
    const [selectedCharacter, setSelectedCharacter] = useState(null);

    function handleCharacterSelection(id){
        setSelectedCharacter(id);
    }

    return (
        <>
            {
                selectedCharacter
                ?<CharacterPage selectedCharacter={selectedCharacter} onSelect={handleCharacterSelection}/>
                :<Homepage onSelect={handleCharacterSelection}/>
            }
        </>
    );
}

function Homepage({onSelect}){
    const [TopCharacters, setTopCharacters] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    useEffect(function(){
        //
        async function getTopCharacters() {
            try {
                setIsLoading(true);
                setError("");

                const result = await fetch('http://localhost/data/get-top-characters');

                if (!result.ok){
                    throw new Error('Kļūda ielādējot datus');
                }

                const data = await result.json();

                setTopCharacters(data);
            } catch (error) {
                console.log(error);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }

        }

        getTopCharacters();
    }, []);

    return (
        <>
        
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
            TopCharacters.map((character, idx) => (<TopCharacter character = {{ ... character, idx: idx}} key ={character.id} onSelect={onSelect}/>))
            )}
        
        </>
    )
}

function TopCharacter({character, onSelect}){
    return (
        <div className="row mb-5 pt-5 pb-5 bg-light">
        <div className={`col-md-6 mt-2 px-5 ${character.idx % 2 === 0 ? 'text-start order-2' : 'text-end order-1'} `}>
            <p className="display-4">{ character.username }</p>
            <p className="lead">{ (character.bio.split(' ').slice(0, 32).join(' ')) + "..." }</p>
            <button className="btn btn-success see-more float-left" onClick={ () => onSelect(character.id)}>Apskatīt</button>
        </div>
        <div className={`col-md-6 text-center ${character.idx % 2 === 0 ? 'order-1' : 'order-2'}`}>
            <img className="img-fluid img-thumbnail rounded-lg w-50" alt= {character.username} src={character.image} />
        </div>
    </div>
    )
}

function CharacterPage({selectedCharacter, onSelect}){
    return (
        <>
        <CharacterDetails selectedCharacter={selectedCharacter} onSelect={onSelect} />
        <RelatedContainer selectedCharacter={selectedCharacter} onSelect={onSelect} />
        </>
    )

}

function CharacterDetails({ selectedCharacter, onSelect }) {
    const [characterData, setCharacterData] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    useEffect(function() {

        async function getCharacterData(selectedCharacter) {

            try {

                setIsLoading(true);
                setError("");

                const result = await fetch('http://localhost/data/get-character/' + selectedCharacter, { mode: 'cors' });

                if (!result.ok) {
                    throw new Error("Kļūda ielādējot datus");
                }

                const data = await result.json();

                setCharacterData(data);

            } catch (error) {
                console.log(error);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        getCharacterData(selectedCharacter);
    }, [selectedCharacter]);

    return (
        <>
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                <div className="row mb-5">
                    <div className="col-md-6 pt-5">
                        <h1 className="display-3">{characterData.username}</h1>
                        <p className="lead">{characterData.bio}</p>
                        <dl className="row">
                            <dt className="col-sm-3">Kvestu punktu skats</dt>
                            <dd className="col-sm-9">{characterData.questPoints}</dd>
                            <dt className="col-sm-3">Kopējais prasmju līmenis</dt>
                            <dd className="col-sm-9">{characterData.totalLevel}</dd>
                            <dt className="col-sm-3">Kolekcijas priekšmetu skaits</dt>
                            <dd className="col-sm-9">{characterData.collectionLogSlots}</dd>
                            <dt className="col-sm-3">Spēles režīms</dt>
                            <dd className="col-sm-9">{characterData.gameMode}</dd>
                        </dl>
                        <button className="btn btn-dark" onClick={ () => onSelect(null) }>Uz sākumu</button>
                    </div>
                    <div className="col-md-6 text-center p-5">
                        <img className="img-fluid img-thumbnail rounded-lg" src={characterData.image} alt={characterData.name} />
                    </div>
                </div>
            )}
        </>
    );
}

function RelatedContainer({ selectedCharacter, onSelect }) {
    const [relatedCharacters, setRelatedCharacters] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState("");

    useEffect(function() {

        async function getRelatedCharacters(selectedCharacters) {

            try {

                setIsLoading(true);
                setError("");

                const result = await fetch('http://localhost/data/get-related-characters/' + selectedCharacter, { mode: 'cors' });

                if (!result.ok) {
                    throw new Error("Kļūda ielādējot datus");
                }

                const data = await result.json();

                setRelatedCharacters(data);

            } catch (error) {
                console.log(error);
                setError(error.message);
            } finally {
                setIsLoading(false);
            }
        }

        getRelatedCharacters(selectedCharacter);
    }, [selectedCharacter]);

    return (
        <>
            {isLoading && <Loading />}
            {error && <ErrorMsg message={error} />}
            {!isLoading && !error && (
                <>
                    <div className="row mt-5">
                        <div className="col-md-12">
                            <h2 className="display-4">Līdzīgi profili</h2>
                        </div>
                    </div>
                    <div className="row mb-5">
                        {relatedCharacters.map((character) => (<RelatedCharacter character={character} key={character.id} onSelect={onSelect} />))}
                    </div>
                </>
            )}
        </>
    );
}

function RelatedCharacter({ character, onSelect }) {
    return (
        <div className="col-md-4">
            <div className="card">
                <img className="card-img-top" src={character.image} alt={character.username} style={{ height: "620px" }} />
                <div className="card-body">
                    <h5 className="card-title">{character.username}</h5>
                    <button className="btn btn-success" onClick={ () => onSelect(character.id) }>Apskatīt</button>
                </div>
            </div>
        </div>
    );
}

function Loading() {
    return (
        <div className="row mb-5 mt-5">
            <div className="text-center">
                <img src="./loading.gif" alt="Lūdzu, uzgaidiet!" className="mx-auto d-block" />
            </div>
        </div>
    );
}

function ErrorMsg({ message }) {
    return (
        <div className="alert alert-danger">
            <p>{message}</p>
            <p>Lūdzu, pārlādējiet lapu!</p>
        </div>
    );
}