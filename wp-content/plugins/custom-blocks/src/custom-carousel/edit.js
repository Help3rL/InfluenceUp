/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
// import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
// import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
// import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
// ...esamų importų tęsinys
import { __ } from "@wordpress/i18n";
import { useBlockProps } from "@wordpress/block-editor";
import "./editor.scss";
import { useEffect, useState } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";
import ServerSideRender from '@wordpress/server-side-render';

const ALLOWED_BLOCKS = ["create-block/custom-card"];

const Edit = () => {
	const blockProps = useBlockProps();
	const [categories, setCategories] = useState([]);

	useEffect(() => {
		apiFetch({ path: "/wp/v2/taxonomies" })
			.then((taxonomies) => {
				console.log("taksonomijos", taxonomies);
				console.log("rtl taksonomijos", taxonomies.rtcl_category);
				if (taxonomies.rtcl_category) {
					// Pataisyta: Naudokite 'rest_base', ne 'href', ir nenaudokite 'replace'
					const basePath = taxonomies.rtcl_category.rest_base;
					const fullPath = `/wp/v2/${basePath}`;

					apiFetch({ path: fullPath })
						.then((categoriesData) => {
							// Apdorokite gautus duomenis
							console.log(categoriesData);
							setCategories(categoriesData);
						})
						.catch((error) => {
							console.error("Klaida gaunant rtcl_category duomenis:", error);
						});
				}
			})
			.catch((error) => {
				console.error("Klaida gaunant taksonomijas:", error);
			});
	}, []);

	// Redagavimo sąsaja
	return (
		<div {...blockProps}>
			<div className="custom-carousel-wrapper">
				{categories.map((category) => (
					<div key={category.id} className="custom-carousel-category">
						{" "}
						{/* Pakeista iš index į category.id */}
						<img
							src={category.image_url || ""}
							alt={category.name || "Category"}
						/>
						<h2 className="carousel-category-name">
							{category.name || "No name"}
						</h2>
					</div>
				))}
			</div>
		</div>
	);
};

export default Edit;
