<?php

namespace App\Controllers;
use App\Models\M_articles;
use App\Models\M_publications;
use App\Models\M_services;
use CodeIgniter\Controller;

class Statiques extends BaseController
{
    public function index()
    {
        $this->afficher('accueil');
    }
    
    public function articles()
    {
        $this->afficher('articles');
    }
    
    public function accueil(){
        $this->afficher('accueil');
       }
    public function contact(){
        $this->afficher('contact');
       }
    
       public function actualites(){
        $this->afficher('actualites');
       }

    public function cabinet(){
        $this->afficher('ministere/cabinet');
       }

    public function sg(){
        $this->afficher('ministere/sg');
       }
    
    public function directions(){
        $this->afficher('ministere/directions');
       }
       
    public function organismes(){
        $this->afficher('ministere/organismes');
       }

    public function energie(){
        $this->afficher('secteurs/energie');
       }
    
    public function electricite(){
        $this->afficher('secteurs/electricite');
       }
    
    public function renouvelable(){
        $this->afficher('secteurs/renouvelable');
       }

    public function gaz(){
        $this->afficher('secteurs/gaz');
       }

    public function hydrocarbure(){
        $this->afficher('secteurs/hydrocarbure');
       }

    public function petrole(){
        $this->afficher('secteurs/petrole');
       }

    public function geologie(){
        $this->afficher('secteurs/geologie');
       }
       
    public function mines(){
        $this->afficher('secteurs/mines');
       }

    public function autorisations(){
        $this->affAutorisation('services/autorisations');
       }

    public function licence(){
        $this->affLicences('services/licence');
       }
    
    public function permis(){
        $this->affPermis('services/permis');
       }
       
    public function titre(){
        $this->affTitres('services/titre');
       }
    
       public function cadastre(){
        $this->afficher('programmes/cadastre');
       }

    public function potentialite(){
        $this->afficher('programmes/potentialite');
       }
       
    public function transition(){
        $this->afficher('programmes/transition');
       }

    public function appel_offre(){
        $this->affOffres('publications/appel_offre');
       }

    public function contrats(){
        $this->affContrats('publications/contrats');
       }

    public function conventions(){
        $this->affConventions('publications/conventions');
       }
    
    public function lois_decrets_arretes(){
        $this->affLois('publications/lois_decrets_arretes');
       }
       
    public function documentation(){
        $this->afficher('publications/documentation');
       }
    

    public function afficher($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_articles();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['articles' => $model->orderBy('id_articles', 'DESC')->paginate(6),
                    'pager' => $pager,
                'alaune' => $model->getArticles(),
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affConventions($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_publications();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['conventions' => $model->where('categorie','convention')->orderBy('id_publications', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affContrats($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_publications();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['contrats' => $model->where('categorie','contrat')->orderBy('id_publications', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affLois($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_publications();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['lois' => $model->where('categorie','lois')->orderBy('id_publications', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affOffres($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_publications();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['offres' => $model->where('categorie','lois')->orderBy('id_publications', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affLicences($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_services();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['licence' => $model->where('categorie','licence')->orderBy('id_services', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affTitres($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_services();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['titres' => $model->where('categorie','titre')->orderBy('id_services', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affPermis($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_services();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['permis' => $model->where('categorie','permis')->orderBy('id_services', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }

    public function affAutorisation($contenu){
        if ( ! is_file(APPPATH.'/Views/statiques/'.$contenu.'.php')){
        throw new \CodeIgniter\Exceptions\PageNotFoundException($contenu);
        }    
        //ajouter pour articles    
        $model = new M_services();
        // pagination
        $pager = service("pager");
        // pagination
        $data = ['autorisation' => $model->where('categorie','autorisation')->orderBy('id_services', 'DESC')->paginate(6),
                    'pager' => $pager,
                ];
    
        $data['titre'] = ucfirst($contenu); 
        $data['contenu'] = $contenu;
        echo view('templates/entete', $data);
        echo view('statiques/'.$contenu, $data);
        echo view('templates/pied', $data);
    }




    public function saveNewletter(){
        $email = $this->request->getVar('email');
        $session = session();

        $model = new M_newletter();
        $data = ['email'=>$email];
        if($id = $model ->insert($data)){
            $session->setFlashdata('success','ok');
            return redirect()->to(site_url('Statiques/accueil'));
        }else{
            $session->setFlashdata('error','no');
            return redirect()->to(site_url('Statiques/accueil'));

        };
    }

}