#include <bits/stdc++.h>

using namespace std;

int chargestoi(string charge){
	if(charge == "3+") return 3;
	if(charge == "2+") return 2;
	if(charge == "+") return 1;
	if(charge == "-") return -1;
	if(charge == "2-") return -2;
	if(charge == "3-") return -3;
	return 0;
}

string chargeitos(int charge){
	string s;
	if(charge > 0){
		if(charge != 1) s += to_string(charge);
		s += "+";
		return s;
	}else if(charge < 0){
		if(charge != -1) s += to_string(charge);
		s += "-";
		return s;
	}
	return "";
}

string to_str(const char c[]){
	string s = c;
	return s;
}

struct molecule{
	map<string, int> atoms;
	int charge = 0;
	string name;
	string formula;
	
	molecule(string s){
		formula = s;
		int idx_charge = s.size();
		for(int i = 0; i < s.size(); i++){
			if(s[i] == '^') idx_charge = i;
		}
		string formula_nc = s.substr(0, idx_charge);
		if(idx_charge != s.size()){
			string str_charge = s.substr(idx_charge + 1, s.size() - (idx_charge + 1));
			charge = chargestoi(str_charge);
		}
		if(formula_nc == "e"){
			return;
		}
		vector<int> start_idxs;
		for(int i = 0; i < formula_nc.size(); i++){
			if(formula_nc[i] >= 'A' && formula_nc[i] <= 'Z'){
				start_idxs.push_back(i);
			}
		}
		start_idxs.push_back(formula_nc.size());
		for(int i = 0; i < start_idxs.size() - 1; i++){
			string s = formula_nc.substr(start_idxs[i], start_idxs[i + 1] - start_idxs[i]);
			string atom;
			int count = 0;
			for(auto c : s){
				if(isalpha(c)) atom.push_back(c);
				if(isdigit(c)) count = count * 10 + c - '0';
			}
			if(count == 0) count = 1;
			atoms[atom] += count;
		}
		
	}
	
	molecule(const char c[]) : molecule(to_str(c)){};
	
	void print(){
		cout << "Information of chemical with chemical formula " << formula << ": " << endl;
		// cout << "Chemical Name: " << name << endl;
		cout << "Atoms: " << endl;
		for(auto i : atoms){
			cout << i.first << ": " << i.second << endl;
		}
		cout << "Charge: " << (charge > 0 ? "+" : "") << charge << endl;
		cout << endl;
	}
};

bool operator< (const molecule& A, const molecule& B){
	return A.formula < B.formula;
}
	
struct cmp{
	bool operator()(const molecule& A, const molecule& B) const{
		return A.formula < B.formula;
	}
};

struct reaction{
	map<molecule, int, cmp> left, right;
	map<string, int> left_atoms, right_atoms;
	int chargeL = 0, chargeR = 0;
	int eL = 0, eR = 0;
	 
	void addLeft(molecule M, int cnt = 1){
		left[M] += cnt;
		for(auto i : M.atoms){
			left_atoms[i.first] += i.second * cnt;
		}
		chargeL += M.charge * cnt;
	}
	
	void addRight(molecule M, int cnt = 1){
		right[M] += cnt;
		for(auto i : M.atoms){
			right_atoms[i.first] += i.second * cnt;
		}
		chargeR += M.charge * cnt;
	}
	
	int getLeftAtom(string s){ return (left_atoms.find(s) == left_atoms.end() ? 0 : left_atoms[s]); }
	int getRightAtom(string s){ return (right_atoms.find(s) == right_atoms.end() ? 0 : right_atoms[s]); }

	map<string, int> getLeftAtoms(){ return left_atoms; }
	map<string, int> getRightAtoms(){ return right_atoms; }

	int getLeftCharge() { return chargeL; }
	int getRightCharge() { return chargeR; }

	void norm(){
		map<molecule, int> common;
		for(auto i : left){
			if(right.find(i.first) != right.end()){
				common[i.first] = min(i.second, right[i.first]);
			}
		}
		for(auto i : common){
			left[i.first] -= i.second; if(left[i.first] == 0) left.erase(i.first);
			right[i.first] -= i.second; if(right[i.first] == 0) right.erase(i.first);
		}
		
		int g = 0;
		for(auto i : left){
			g = __gcd(g, i.second);
		}
		for(auto i : right){
			g = __gcd(g, i.second);
		}
		for(auto& i : left){
			i.second /= g;
		}
		for(auto& i : right){
			i.second /= g;
		}
		
		left_atoms.clear(), right_atoms.clear();
		for(auto i : left){
			for(auto a : i.first.atoms){
				left_atoms[a.first] += a.second * i.second;
			}
		}
		for(auto i : right){
			for(auto a : i.first.atoms){
				right_atoms[a.first] += a.second * i.second;
			}
		}
	}
	
	void print(string info = "chemical reaction"){
		cout << "Information of " << info << ":" << endl;
		cout << "reactant: " << endl;
		for(auto i : left){
			cout << (i.second == 1 ? "" : to_string(i.second)) << i.first.formula << endl;
		}
		cout << "product: " << endl;
		for(auto i : right){
			cout << (i.second == 1 ? "" : to_string(i.second)) << i.first.formula << endl;
		}
		cout << endl;
	}
	
};

void addReaction(reaction& result, reaction added, int cnt = 1){
	for(auto i : added.left){
		result.addLeft(i.first, i.second * cnt);
	}
	for(auto i : added.left_atoms){
		result.left_atoms[i.first] += i.second * cnt;
	}

	for(auto i : added.right){
		result.addRight(i.first, i.second * cnt);
	}
	for(auto i : added.right_atoms){
		result.right_atoms[i.first] += i.second * cnt;
	}
	result.eL += added.eL * cnt, result.eR += added.eR * cnt;
}

reaction redox_half(molecule A, molecule B, bool alkaline = false){
	reaction result;
	
	set<string> common;
	for(auto i : A.atoms){
		if(i.first != "O" && i.first != "H"){
			common.insert(i.first);
		}
	}
	string common_atom = "";
	for(auto i : B.atoms){
		if(common.find(i.first) != common.end()){
			common_atom = i.first;
		}
	}
	
	int atomA = 1, atomB = 1;
	if(common_atom != ""){
		atomA = A.atoms[common_atom];
		atomB = B.atoms[common_atom];
	}
	
	result.addLeft(A, atomB / __gcd(atomA, atomB));
	result.addRight(B, atomA / __gcd(atomA, atomB));
	if(result.getLeftAtom("O") < result.getRightAtom("O")){
		result.addLeft("H2O", result.getRightAtom("O") - result.getLeftAtom("O"));
	}
	
	if(result.getLeftAtom("O") > result.getRightAtom("O")){
		result.addRight("H2O", result.getLeftAtom("O") - result.getRightAtom("O"));
	}
	
	if(result.getLeftAtom("H") < result.getRightAtom("H")){
		int diff = result.getRightAtom("H") - result.getLeftAtom("H");
		if(!alkaline) result.addLeft("H^+", diff);
		else result.addLeft("H2O", diff), result.addRight("OH^-", diff);
	}

	if(result.getLeftAtom("H") > result.getRightAtom("H")){
		int diff = result.getLeftAtom("H") - result.getRightAtom("H");
		if(!alkaline) result.addRight("H^+", diff);
		else result.addRight("H2O", diff), result.addLeft("OH^-", diff);
	}
	
	if(result.getLeftCharge() > result.getRightCharge()){
		result.addLeft("e^-", result.getLeftCharge() - result.getRightCharge());
	}
	
	if(result.getRightCharge() > result.getLeftCharge()){
		result.addRight("e^-", result.getRightCharge() - result.getLeftCharge());
	}
	result.norm();
	return result;
}

reaction redox(reaction A, reaction B){
	reaction result;
	A.print(); B.print();
	int eA = (A.left.find("e^-") == A.left.end() ? 0 : A.left["e^-"]) - (A.right.find("e^-") == A.right.end() ? 0 : A.right["e^-"]);
	int eB = (B.left.find("e^-") == B.left.end() ? 0 : B.left["e^-"]) - (B.right.find("e^-") == B.right.end() ? 0 : B.right["e^-"]);
	int g = abs(__gcd(eA, eB));
	addReaction(result, A, abs(eB) / g);
	addReaction(result, B, abs(eA) / g);
	result.norm();
	return result;
}

int32_t main(){
	molecule Cr2O7 = molecule("Cr2O7^2-");
	molecule Cr = molecule("Cr^3+");
	molecule SO3 = molecule("SO3^2-");
	molecule SO4 = molecule("SO4^2-");
	reaction sulphite = redox_half(SO3, SO4);
	reaction dichromate = redox_half(Cr2O7, Cr);
	reaction manganese = redox_half("MnO4^-", "Mn^2+");
	reaction H2S = redox_half("H2SO4", "H2S");
	reaction I2 = redox_half("I^-", "I2");
	
	reaction MnO2 = redox_half("MnO4^-", "MnO2");
	MnO2.print();
//	CO2.print("half redox of carbon reduction (to carbon dioxide): ");
	reaction H2S_I2 = redox(H2S, I2);
//	Cr2O7.print();
//	sulphite.print();
//	dichromate.print();
//	manganese.print();
//	H2S.print();
	H2S_I2.print("redox with conc. sulphuric acid as reducing agent and iodine as oxidizing agent");
	// reducing agents
	// Mg -> Mg^2+ + 2e
	// SO3^2- + H2O -> SO4^2- + 2H^+

	// oxidizing agents
	// O2 + 2H2O + 4e -> 4OH^-
	// Ag^+ + e -> Ag
	// Cr2O7^2- + 14H^+ + 6e -> 2Cr^3+ + 7H2O
}
