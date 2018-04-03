<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Personeel Model
 *
 * @property \App\Model\Table\AdresTable|\Cake\ORM\Association\BelongsTo $Adres
 * @property \App\Model\Table\RolTable|\Cake\ORM\Association\BelongsTo $Rol
 *
 * @method \App\Model\Entity\Personeel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Personeel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Personeel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Personeel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Personeel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Personeel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Personeel findOrCreate($search, callable $callback = null, $options = [])
 */
class PersoneelTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('personeel');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Adres', [
            'foreignKey' => 'adres_id'
        ]);
        $this->belongsTo('Rol', [
            'foreignKey' => 'rol_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('voornaam')
            ->allowEmpty('voornaam');

        $validator
            ->scalar('achternaam')
            ->allowEmpty('achternaam');

        $validator
            ->boolean('actief')
            ->allowEmpty('actief');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['adres_id'], 'Adres'));
        $rules->add($rules->existsIn(['rol_id'], 'Rol'));

        return $rules;
    }
}
